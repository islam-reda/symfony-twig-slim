<?php
namespace App\Models;

class Core_Validation
{
    protected $error=array();
    protected $input=array();
    protected $error_messages = array();
    protected $_rules=array();

    function add($val,$rules=array(),$error_msg='')
    {

        if(!in_array($val, $this->input))
        {
            $this->input[$val] = $_POST[$val];
        }
        $this->error_messages[$val] = $error_msg;
        $this->_rules[$val] = $rules;
        return $this;
    }

    function remove($val)
    {
        if(!empty($val))
        {
            unset($this->_rules[$val]);
            unset($this->error_messages[$val]);
            unset($this->input[$val]);
        }

        return $this;
    }


    function set_message($key='',$msg,$force=0)
    {
        if(empty($key))
        {
            throw new ErrorException('Fieldname should not be empty');

            exit;
        }

        $this->error_messages[$key]=$msg;

        if($force==1)
        {
            $this->error[$key]=1;
        }
    }

    function error($key='')
    {
        if(!empty($key) )
        {

            if($this->error[$key]==1)
            {
                return $this->error_messages[$key];
            }
            else
            {
                return false;
            }
        }
        return $this->error_messages;
    }

    function errors()
    {
        foreach($this->error_messages as $key=>$val)
        {

            if($this->error[$key]==0)
            {
                $this->error_messages[$key]='';
            }
        }
        return $this->error_messages;
    }

    function input($key='')
    {
        if(!empty($key))
        {
            return $this->input[$key];
        }
        return $this->input;
    }

    function run_validation()
    {
        $result=true;
        foreach($this->input as $key=>$val)
        {
            $this->error[$key]=0;
            if(count($this->_rules[$key])>0)
            {
                foreach($this->_rules[$key] as $rule)
                {
                    $params = array($val);
                    //$return= $this->$rule($_POST[$val]);
                    $exp = explode(':', $rule);
                    if(count($exp) > 1)
                    {
                        $params[] = $exp[1];
                    }
                    $return =  call_user_func_array(array($this,'_valid_'.$exp[0]),$params);
                    unset($params);
                    if($return == false)
                    {
                        $result = false;
                        $this->error[$key] = 1;
                    }
                }
            }
        }

        return $result;
    }

    /*
     * The functions we call in second parameter
     */
    /**
     *
     * @param type $val
     * @return type
     */
    function _valid_match_pattern($val,$pattern="#\s#")
    {
        if(preg_match($pattern,$val))
        {

            return true;
        }
        return false;
    }
    function  _valid_alpha($val)
    {

        if(preg_match('#^[A-Za-z]+$#',$val))
        {

            return true;
        }
        return false;
    }

    function  _valid_required($val)
    {

        if(empty($val) or $val==null)
        {

            return false;
        }
        return true;
    }

    function _valid_nonemptyarray($val)
    {
        if(is_array($val) and count($val)>0)
        {
            return true;
        }

        return false;
    }
    function _valid_minlength($val,$length)
    {
        if(strlen($val)>=$length)
        {
            return true;
        }

        return false;
    }
    function _valid_maxlength($val,$length)
    {
        if(strlen($val)>$length)
        {
            return false;
        }

        return true;
    }
    function _valid_username($val)
    {
        #echo $parem."<br>";
        $pattern = "/^[a-zA-Z0-9._-]+$/";
        if (preg_match($pattern,$val))
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function _valid_email($val)
    {

        $var=filter_var($val, FILTER_VALIDATE_EMAIL);

        return $var;
    }
    function _valid_number($parem)
    {
        $pattern = "/^[0-9]+$/";
        if (preg_match($pattern,$parem))
        {
            return true;
        }
        else
        {
            return  false;
        }

    }
    //checking float//
    function valid_float($parem)
    {
        if (!stristr("/^[+-]?(([0-9]+)|([0-9]*\.[0-9]+|[0-9]+\.[0-9]*)|(([0-9]+|([0-9]*\.[0-9]+|[0-9]+\.[0-9]*))[eE][+-]?[0-9]+))$/", $parem))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    //checking dates//
    function valid_date($parem)
    {
        if (!preg_match("^[0-9]{4}\\-[0-9]{1,2}\\-[0-9]{1,2}$", $parem))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function _valid_combobox($val)
    {


        return (empty($val) or $val=="#na#") ? false:true;
    }

    function  _valid_match_value($val,$param)
    {
        return ($val === $_POST[$param]) ? true : false;
    }

    static function _valid_unique($val, $options)
    {
        list($table, $field) = explode('.', $options);
        $result = Db::rowCnt( $table, "where $field='$val'");
        return ($result<1) ? true :false;


    }
    static function _valid_expr($val, $options)
    {

        $data = explode('.', $options);

        $result = Db::rowCnt( $data[0], "where $data[1]= '$val' $data[2]");
        return ($result==1) ? true :false;


    }
    static function _valid_unique_edit($val, $options)
    {
        list($table, $field) = explode('.', $options);
        $result = Db::rowCnt( $table, "where $field='$val'");
        return ($result<=1) ? true :false;


    }
    static function _valid_url($val)
    {
        $pattern = '/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/';
        //return preg_match($pattern, $url);
        return true;
    }
    public static function _valid_float($val)
    {
        $pattern="/^[0-9]{1,7}(\.[0-9]{1,2})?$/";
        return preg_match($pattern,$val) ? true :false;
    }
}
if(!class_exists('Formvalidation'))
{
    class Formvalidation extends Core_Validation{
        static function _valid_changepassword($val, $options)
        {
            $val=Security::do_hash($val,SALT);

            return parent::_valid_expr($val, $options);



        }
    }
}
?>
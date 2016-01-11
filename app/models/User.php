<?php

use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class User extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $uname;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $salt;

    /**
     *
     * @var integer
     */
    public $gender;

    /**
     *
     * @var string
     */
    public $nickname;

    /**
     *
     * @var integer
     */
    public $is_active;

    /**
     *
     * @var integer
     */
    public $ctime;

    /**
     *
     * @var integer
     */
    public $is_del;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->validate(
            new Email(
                array(
                    'field' => 'email',
                    'required' => true,
                )
            )
        );

        $this->validate(new Uniqueness(array(
            "field"   => "email",
            "message" => "Value of field 'email' is already present in another record"
        )));

        if ($this->validationHasFailed() == true) {
            return false;
        }

        return true;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * User register
     * @param $email
     * @param $password
     * @param $nickname
     * @return int
     */
    public function register($email, $password, $nickname)
    {
        $this->email = $email;
        $this->salt = rand(11111, 99999);
        $this->password = md5(md5($password) . $this->salt);;
        $this->nickname = $nickname;
        $this->ctime = time();
        if ($this->validation()) {
            $this->save();
        }
        return $this->id;
    }

    public function getList()
    {
        $return_users = array();
        foreach ($this->find() as $user) {
            $return_user = array();
            $return_user['id'] = $user->id;
            $return_user['email'] = $user->email;
            $return_user['nickname'] = $user->nickname;
            $return_user['ctime'] = $user->ctime;
            $return_users[] = $return_user;
        }
        return $return_users;
    }

}

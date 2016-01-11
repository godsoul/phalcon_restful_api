<?php
/**
 * Created by IntelliJ IDEA.
 * User: godsoul
 * Date: 2016/1/10
 * Time: 23:29
 */
class UserController extends BaseController{

    /**
     * fetch all user
     */
    public function userList()
    {
        $user = new User();
        $this->app->response->setJsonContent($user->getList());
        return $this->app->response;
    }

    /**
     *  user register
     * @return mixed
     */
    public function create()
    {

        $params = $this->app->request->getJsonRawBody();
        if (($params != NULL) && ($params->email && $params->password && $params->nickname)) {
            $user = new User();
            $userId = $user->register($params->email,$params->password,$params->nickname);
            if ($userId) {
                $this->response(201, 0, $userId);
            }else{
                $this->response(409, 2000);
            }
        }else{
            $this->response(400, 1000);
        }
        return $this->app->response;
    }
}
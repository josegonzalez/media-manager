<?php
namespace App\Auth;

use Cake\Auth\BasicAuthenticate;
use Cake\Network\Request;

class HeaderAuthenticate extends BasicAuthenticate
{
    protected $_defaultConfig = [
       'fields' => [
           'username' => 'username',
           'password' => 'password',
           'name' => 'name',
           'email' => 'email',
       ],
       'headers' => [
           'username' => 'AUTH_USERNAME',
           'name' => 'AUTH_NAME',
           'email' => 'AUTH_EMAIL',
       ],
       'userModel' => 'Users',
       'scope' => [],
       'finder' => 'all',
       'contain' => null,
       'passwordHasher' => 'Default'
    ];

    /**
     * Authenticate a user using custom headers.
     *
     * If the user does not exist in the database but
     * the correct header was passed, simply create the
     * user using the provided header data
     *
     * @param \Cake\Network\Request $request Request object.
     * @return mixed Either false or an array of user information
     */
    public function getUser(Request $request)
    {
        $config = $this->_config;
        $username = $request->header($config['headers']['username']);
        if (empty($username)) {
            return false;
        }

        $result = $this->_getUser($request);
        if (empty($result)) {
            return false;
        }

        $result->unsetProperty($config['fields']['password']);
        return $result->toArray();
    }


    /**
     * Retrieves or creates a user based on header data
     *
     * @param \Cake\Network\Request $request Request object.
     * @return mixed Either false or an array of user information
     */
    protected function _getUser(Request $request)
    {
        $config = $this->_config;
        $username = $request->header($config['headers']['username']);
        $result = $this->_query($username)->first();
        if (!empty($result)) {
            return $result;
        }

        $data = [
            $config['fields']['username'] => $username,
            $config['fields']['password'] => '',
            $config['fields']['name'] => $request->header($config['headers']['name']),
            $config['fields']['email'] => $request->header($config['headers']['email']),
        ];

        $table = TableRegistry::get($config['userModel']);
        $result = $table->newEntity($data);
        if (!$table->save($result)) {
            return false;
        }
        return $result;
    }
}

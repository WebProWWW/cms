<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-05 04:24
 */

namespace console\controllers;

use components\user\Access;
use components\user\AuthManager;

use yii\console\Controller;
use yii\console\ExitCode;

class AppController extends Controller
{
    public function actionInstall()
    {
        $auth = new AuthManager();
        $auth->removeAll();
        try {
            foreach (Access::roles() as $role => $desc) {
                $this->createRole($auth, $role, $desc);
            }
        } catch (\Exception $exception) {
            $this->stdout('Error: '.$exception->getMessage().PHP_EOL);
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    /**
     * @param AuthManager $authManager
     * @param string $role
     * @param string $desc
     * @throws \Exception
     */
    private function createRole($authManager, $role, $desc)
    {
        $user = $authManager->createRole($role);
        $user->description = $desc;
        $authManager->add($user);
    }
}
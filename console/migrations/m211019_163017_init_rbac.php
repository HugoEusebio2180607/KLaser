<?php

use yii\db\Migration;

/**
 * Class m211019_163017_init_rbac
 */
class m211019_163017_init_rbac extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = Yii::$app->authManager;

        $createProduto = $auth->createPermission('createProduto');
        $createProduto->description = 'Criar produto';
        $auth->add($createProduto);

        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);

        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        $auth->addChild($funcionario, $createProduto);

        $admin = $auth->createRole('Admin');
        $auth->add($admin);
        $auth->addChild($admin, $cliente);


        $auth->assign($admin, 1);
        $auth->assign($cliente, 3);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

}

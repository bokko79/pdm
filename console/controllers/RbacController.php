<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //--------------RULES
        //Rule Project
        $projectRule = new \common\rbac\ProjectRule();
        $auth->add($projectRule);

        //View Rule Project
        $viewProjectRule = new \common\rbac\ViewProjectRule();
        $auth->add($viewProjectRule);

        //Update Control Rule Project
        $updateControlProjectRule = new \common\rbac\ControlProjectRule();
        $auth->add($updateControlProjectRule);

        //Rule Client
        $clientRule = new \common\rbac\ClientRule();
        $auth->add($clientRule);

        //Rule Practice
        $practiceRule = new \common\rbac\PracticeRule();
        $auth->add($practiceRule);

        //Rule Leave Practice
        $leavePracticeRule = new \common\rbac\LeavePracticeRule();
        $auth->add($leavePracticeRule);

        //Rule Order
        $orderRule = new \common\rbac\OrderRule();
        $auth->add($orderRule);

        //Rule Post
        $postRule = new \common\rbac\PostRule();
        $auth->add($postRule);

        //Rule User Profile
        $engineerProfileRule = new \common\rbac\EngineerProfileRule();
        $auth->add($engineerProfileRule);


        //-------------CREATE PERMISSIONS  
      

        //PROJECTS  
        
        //Permission to create a project
        $createProject = $auth->createPermission('createProject');
        $createProject->description = 'Create Projects';
        $auth->add($createProject);

        //Permission to update a project
        $updateProject = $auth->createPermission('updateProject');
        $updateProject->description = 'Update Projects';
        $auth->add($updateProject);       

        //Permission to update own project
        $updateOwnProject = $auth->createPermission('updateOwnProject');
        $updateOwnProject->description = 'Update Own Project';
        $updateOwnProject->ruleName = $projectRule->name;
        $auth->add($updateOwnProject);
        $auth->addChild($updateProject, $updateOwnProject); 

        //Permission to update general details of project
        $updateGeneralProject = $auth->createPermission('updateGeneralProject');
        $updateGeneralProject->description = 'Update Gerneral Project';
        $updateGeneralProject->ruleName = $clientRule->name;
        $auth->add($updateGeneralProject);
        $auth->addChild($updateOwnProject, $updateGeneralProject);

        //Permission to update control part of project
        $updateControlProject = $auth->createPermission('updateControlProject');
        $updateControlProject->description = 'Update Control Project';
        $updateControlProject->ruleName = $updateControlProjectRule->name;
        $auth->add($updateControlProject);
        $auth->addChild($updateGeneralProject, $updateControlProject);

        //Permission to view a project
        $viewProject = $auth->createPermission('viewProject');
        $viewProject->description = 'View Project';
        $viewProject->ruleName = $viewProjectRule->name;
        $auth->add($viewProject);
        $auth->addChild($updateControlProject, $viewProject);



        //ORDERS

        //Permission to create an order
        $createOrder = $auth->createPermission('createOrder');
        $createOrder->description = 'Create Orders';
        $auth->add($createOrder);

        //Permission to update an order
        $updateOrder = $auth->createPermission('updateOrder');
        $updateOrder->description = 'Update Order';
        $auth->add($updateOrder);

        //Permission to comment an order
        $commentOrder = $auth->createPermission('commentOrder');
        $commentOrder->description = 'Comment on Order';
        $auth->add($commentOrder);

        //Permission to update own order
        $updateOwnOrder = $auth->createPermission('updateOwnOrder');
        $updateOwnOrder->description = 'Update Own Order';
        $updateOwnOrder->ruleName = $orderRule->name;
        $auth->add($updateOwnOrder);
        $auth->addChild($updateOrder, $updateOwnOrder);


        //POSTS

        //Permission to create a post
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create Posts';
        $auth->add($createPost);

        //Permission to update a post
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update Post';
        $auth->add($updatePost);

        //Permission to update own post
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update Own Post';
        $updateOwnPost->ruleName = $postRule->name;
        $auth->add($updateOwnPost);
        $auth->addChild($updatePost, $updateOwnPost);


        //PRACTICES  

        //Permission to create a practice
        $createPractice = $auth->createPermission('createPractice');
        $createPractice->description = 'Create Practice';
        $auth->add($createPractice);

        //Permission to create a practice
        $joinPractice = $auth->createPermission('joinPractice');
        $joinPractice->description = 'Join Practice';
        $auth->add($joinPractice);

        //Permission to update a practice
        $updatePractice = $auth->createPermission('updatePractice');
        $updatePractice->description = 'Update Practice';
        $auth->add($updatePractice);

        //Permission to update own practice
        $updateOwnPractice = $auth->createPermission('updateOwnPractice');
        $updateOwnPractice->description = 'Update Own Practice';
        $updateOwnPractice->ruleName = $practiceRule->name;
        $auth->add($updateOwnPractice);
        $auth->addChild($updatePractice, $updateOwnPractice);

        //Permission to leave practice
        $leavePractice = $auth->createPermission('leavePractice');
        $leavePractice->description = 'Leave Practice';
        $leavePractice->ruleName = $leavePracticeRule->name;
        $auth->add($leavePractice);
        $auth->addChild($updatePractice, $leavePractice);


        //USER PROFILE

        //Permission to update a user profile
        $updateEngineer = $auth->createPermission('updateEngineer');
        $updateEngineer->description = 'Update Engineer Profile';
        $auth->add($updateEngineer);

        //Permission to update own profile
        $updateOwnEngineerProfile = $auth->createPermission('updateOwnEngineerProfile');
        $updateOwnEngineerProfile->description = 'Update Own Profile';
        $updateOwnEngineerProfile->ruleName = $engineerProfileRule->name;
        $auth->add($updateOwnEngineerProfile);
        $auth->addChild($updateEngineer, $updateOwnEngineerProfile);


        //CORE DATABASE

        //Permission to update the core database
        $manageCoreDatabase = $auth->createPermission('manageCoreDatabase');
        $manageCoreDatabase->description = 'Manage Core Database';
        $auth->add($manageCoreDatabase);


        //APPLICATION

        //Permission to update application
        $manageApplication = $auth->createPermission('manageApplication');
        $manageApplication->description = 'Manage Application';
        $auth->add($manageApplication);


        //---------------------ROLES
        //Role User
        $user = $auth->createRole('user');
        $auth->add($user);
        //Role Engineer
        $engineer = $auth->createRole('engineer');
        $auth->add($engineer);
        $auth->addChild($engineer, $user);
        $auth->addChild($engineer, $updateOwnEngineerProfile);
        $auth->addChild($engineer, $createProject);
        $auth->addChild($engineer, $viewProject);
        $auth->addChild($engineer, $updateControlProject);
        $auth->addChild($engineer, $updateOwnProject);
        $auth->addChild($engineer, $commentOrder);
        $auth->addChild($engineer, $createPractice);
        $auth->addChild($engineer, $joinPractice);
        $auth->addChild($engineer, $updateOwnPractice);
        $auth->addChild($engineer, $leavePractice);
        $auth->addChild($engineer, $createPost);
        $auth->addChild($engineer, $updateOwnPost);
        //Role Client
        $client = $auth->createRole('client');
        $auth->add($client);
        $auth->addChild($client, $user);
        $auth->addChild($client, $createOrder);
        $auth->addChild($client, $updateOwnOrder);       
        $auth->addChild($client, $updateGeneralProject);
        //Role Editor
        $editor = $auth->createRole('editor');
        $auth->add($editor);
        $auth->addChild($editor, $engineer);
        $auth->addChild($editor, $updatePost);
        //Role Admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $editor);
        $auth->addChild($admin, $updateOrder);
        $auth->addChild($admin, $updateProject);
        $auth->addChild($admin, $updatePractice);
        $auth->addChild($admin, $updateEngineer);
        $auth->addChild($admin, $manageCoreDatabase);
        //Role Owner
        $owner = $auth->createRole('owner');
        $auth->add($owner);
        $auth->addChild($owner, $admin);  
        $auth->addChild($owner, $manageApplication);        
    }
}
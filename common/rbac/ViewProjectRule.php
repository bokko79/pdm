<?php 
namespace common\rbac;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class ViewProjectRule extends Rule
{
    public $name = 'isProjectParticipant';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        // all participants who can see the project
        // client
        // project manager
        // supervision engineer
        // builder engineer
        // all partners of project manager
        // engineers
        // control engineers
        if(isset($params['project'])) {
            $project = $params['project'];
            if($project->engineer_id==$user or $project->client_id==$user or $project->control_engineer_id==$user  or $project->builder_engineer_id==$user  or $project->supervision_engineer_id==$user){
                return true;
            }
            if($volumes = $project->projectVolumes){
                foreach($volumes as $volume){
                    if($volume->engineer_id==$user or $volume->control_engineer_id==$user){
                        return true;
                        break;
                    }
                }
            }
            if($partners = $project->practice->practiceEngineers){
                foreach($partners as $partner){
                    if($partner->engineer_id==$user){
                        return true;
                        break;
                    }
                }
            }
        }
        return false;
    }
}
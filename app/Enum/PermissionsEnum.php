<?php

namespace App\Enum;

enum PermissionsEnum: string
{
    case ManageFeatures = 'manage_features';
    case ManageUsers = 'manage_users';
    case ManageComments = 'manage_comments';
    case ManagePosts = 'manage_posts';
    case ManageDownVotes = 'manage_down_votes';
}

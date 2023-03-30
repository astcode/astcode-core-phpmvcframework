<?php

namespace Astcode\Core;

use Astcode\Core\DB\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}

<?php

namespace Tests;

use Yii;
use yii\helpers\ArrayHelper;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
	protected function setUp(): void
	{
		date_default_timezone_set('Asia/Shanghai');
	}
}

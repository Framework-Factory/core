<?php

namespace FrameworkFactory\Contracts\Commands {

	abstract class Command
	{
		protected string $name;
		protected string $basePath;
		protected string $stubPath;
	}
}
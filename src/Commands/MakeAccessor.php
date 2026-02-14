<?php

namespace FrameworkFactory\Commands {

	use FrameworkFactory\Contracts\Commands\Command;
	use FrameworkFactory\Application;

	class MakeAccessor extends Command
	{
		public function __construct(string $name)
		{
			$this->name = $name;
			$this->basePath = Application::basePath();
			$this->stubPath = __DIR__ . '/../../stubs/accessor.stub';
		}

		public function handle(): void
		{
			$this->ensureProvidersDirectoryExists();

			$filePath = $this->getDestinationPath();

			if (file_exists($filePath)) {
				echo "Accessor already exists.\n";
				return;
			}

			$contents = $this->buildClass();

			file_put_contents($filePath, $contents);

			echo "Accessor class created: {$filePath}\n";
		}

		protected function ensureProvidersDirectoryExists(): void
		{
			$path = Application::appDirectory() . '/Accessors';

			if (!mkdir($path, 0755, true) && !is_dir($path)) {
				throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
			}
		}

		protected function getDestinationPath(): string
		{
			return Application::appDirectory() . '/Accessors/' . $this->name . '.php';
		}

		protected function buildClass(): string
		{
			$stub = file_get_contents($this->stubPath);

			return str_replace(
				['{{ namespace }}', '{{ class }}'],
				[Application::appNamespace() . 'Accessors', $this->name],
				$stub
			);
		}
	}
}
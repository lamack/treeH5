<?php


namespace app\index\crontab;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Index extends Command
{
    protected function configure()
    {
        $this->setName('test')->setDescription('Here is the remark ');
    }

    protected function execute(Input $input, Output $output)
    {
        $output->writeln("TestCommand:");
        $this->test();
    }

    private function test(){
       echo "test\r\n";
    }
}

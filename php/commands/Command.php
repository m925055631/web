<?php 

abstract class Command {
	abstract function excute(CommandContext $context);
}

?>
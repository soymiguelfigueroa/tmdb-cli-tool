<?php

namespace Mfigu\TmdbCliTool\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'get:movies',
    description: 'Fetches movies from TMDB',
    help: 'This command allows you to fetch movies from The Movie Database (TMDB).'
)]
class GetMoviesCommand extends Command
{
    protected function configure():void
    {
        $this->addOption(
            'type',
            't',
            InputOption::VALUE_REQUIRED,
            'Type of movies to fetch (playing, popular, top or upcoming)',
        );
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        switch ($input->getOption('type')) {
            case 'playing':
                $output->writeln('Fetching currently playing movies...');
                break;
            
            case 'popular':
                $output->writeln('Fetching popular movies...');
                break;

            case 'top':
                $output->writeln('Fetching top movies...');
                break;

            case 'upcoming':
                $output->writeln('Fetching upcoming movies...');
                break;
            
            default:
                $output->writeln('Invalid type specified. Please use playing, popular, top, or upcoming.');
                return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}
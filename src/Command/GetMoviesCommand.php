<?php

namespace Mfigu\TmdbCliTool\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Mfigu\TmdbCliTool\Classes\Movies;

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
        $type = $input->getOption('type');

        if (!$type) {
            $output->writeln('<error>Please specify a type using --type option.</error>');
            return Command::FAILURE;
        }

        $output->writeln('Fetching currently playing movies...');
        $movies = Movies::getMovies($type);
        foreach ($movies['data']['results'] as $movie) {
            $output->writeln("Title: {$movie['title']}, Release Date: {$movie['release_date']}");
        }
        $output->writeln($movies['status_message']);
        return Command::SUCCESS;
    }
}
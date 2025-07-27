# TMDB CLI Tool

This project is a API to fetch movie information and display it in the terminal.

## Project URL

[Roadmap TMDB CLI Tool](https://roadmap.sh/projects/tmdb-cli)

## Requirements

You will need PHP (V8 or higher) to use this app. After that, you need to install composer in order to get the required packages.

## Installation

- clone this repository and go into it:

```
git clone git@github.com:soymiguelfigueroa/tmdb-cli-tool.git

cd tmdb-cli-tool
```

- Install dependencies

```
composer install
```

- Copy the .env.example file as .env

- Set the API key (You'll need to sign up into TMDB and get your own API key).

# Usage

To run the up, you can prompt this command:

```
php tmdb-app get:movies --type "playing"
```

You can set the value of type in one of these options:

- playing
- popular
- top
- upcoming
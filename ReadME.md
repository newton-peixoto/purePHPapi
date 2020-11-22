# REST API example application

This is a pure PHP api to store pokemons. The database is based on a json file. This idea came from a youtube [video](https://www.youtube.com/watch?v=NxHY14rMPvc)

## Install

    git clone https://github.com/newton-peixoto/purePHPapi.git

    cd purePHPapi

    composer dump-autoload

    php -S localhost:8000 


# REST API

The REST API to the example app is described below.

## Get list of Pokemons

### Request

`GET /pokemon/`

## Create a new Pokemon

### Request

`POST /pokemon/`

{
    "name": "Poke Name",
    "type" : "Poke Type"
}

## Get a specific Pokemon

### Request

`GET /pokemon/:id`


## Update a specific Pokemon

### Request

`PUT /pokemon/:id/`

{
    "name": "Poke new Name",
    "type" : "Poke new Type"
}

### Request


## Delete a specific Pokemon

`DELETE /pokemon/:id`

### Response

{"success":true,"data":"Deleted!"}


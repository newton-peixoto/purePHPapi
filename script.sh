

#call to default route

echo "Call to default route /pokemon"
curl localhost:8000/pokemon

echo "Call to create route"
curl --location --request POST 'http://localhost:8000/pokemon' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "Teste",
    "type" : "Fire"
}'

#!/bin/bash

DBList=("DM" "notify" "tweet" "user")

for db in ${DBList[@]}
do
mongoimport --db FishyKink --collection "${db}" --file /vagrant/source/func/db/"${db}".json
done
exit 0

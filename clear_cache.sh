#!/bin/bash

for dir in $(ls cache)
do
    rm -r cache/$dir
done

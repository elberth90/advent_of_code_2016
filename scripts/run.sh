#!/bin/bash

for D in src/*; do
    if [ ! -d "${D}" ]; then
        continue
    fi
    if [ -f "${D}/Main.php" ]; then
        echo "${D}: "`php "${D}/Main.php"`
    fi
done

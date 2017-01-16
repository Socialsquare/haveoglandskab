#!/bin/bash
echo $SSH_PRIVATE_KEY | base64 -d > ~/.ssh/id_haveoglandskab_dk
cat ~/.ssh/id_haveoglandskab_dk

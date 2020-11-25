#!/usr/bin/env bash

set -o errexit
set -o pipefail

docker-compose --file docker-compose.yaml \
		--project-name talentify \
		up --detach \
		--force-recreate \
		--build

echo "created talentify application"

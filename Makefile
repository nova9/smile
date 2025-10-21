# Docker configuration
REGISTRY = registry.digitalocean.com/smile-registry
IMAGE_NAME = smile-app
TAG = latest
FULL_IMAGE_NAME = $(REGISTRY)/$(IMAGE_NAME):$(TAG)
PLATFORMS = linux/amd64

# Build and push multi-arch image
.PHONY: build
build:
	docker buildx build --platform $(PLATFORMS) -t $(FULL_IMAGE_NAME) .

# Push existing image (if already built and tagged locally)
.PHONY: push
push:
	docker push $(FULL_IMAGE_NAME)

# Clean up local images
.PHONY: clean
clean:
	docker rmi $(FULL_IMAGE_NAME) || true

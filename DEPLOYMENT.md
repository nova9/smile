# Deployment Scripts for DigitalOcean Kubernetes

This directory contains scripts and configuration files for deploying the Smile Laravel application on DigitalOcean Managed Kubernetes.

## ⚠️ BEFORE DEPLOYING - CRITICAL STEPS

**🛑 STOP! Complete these steps before running any deployment commands:**

### 1. Generate Laravel Application Key

```bash
# Generate a new application key
php artisan key:generate --show
```

Copy the generated key (including `base64:` prefix) for use in secrets.yaml

### 2. Update Secrets Configuration

Edit `k8s/secrets.yaml` and replace ALL placeholder values:

#### Required Changes

- **APP_KEY**: Use the key generated above
- **DB_PASSWORD**: Create a strong database password
- **APP_URL**: Your actual domain (e.g., `https://myapp.com`)

#### Recommended Changes

- **OPENAI_API_KEY**: Your OpenAI API key for AI features
- **AWS_ACCESS_KEY_ID** & **AWS_SECRET_ACCESS_KEY**: For file storage
- **MAIL_***: Email service configuration
- **Root MySQL Password**: Change the default in `k8s/mysql.yaml`

### 3. Update Image References

Replace `your-registry/smile-app:latest` in these files:

- `k8s/app.yaml`
- `k8s/workers.yaml`

Example: `registry.digitalocean.com/your-registry/smile-app:latest`

### 4. Update Domain Configuration

In `k8s/app.yaml`, replace `your-domain.com` with your actual domain name in:

- Ingress host configuration
- TLS certificate configuration

### 5. Verify Environment Files

Ensure you have a proper `.env` file for local development:

```bash
cp .env.example .env
# Edit .env with your local configuration
```

### 6. DNS Configuration

**Before deploying**, ensure your domain DNS points to your DigitalOcean Load Balancer:

- Deploy first to get the Load Balancer IP
- Update your DNS A record to point to this IP
- SSL certificates will only work after DNS is properly configured

## Prerequisites

1. **DigitalOcean Account**: Set up a DigitalOcean account and create a Kubernetes cluster
2. **Docker Registry**: Set up a container registry (DigitalOcean Container Registry or Docker Hub)
3. **kubectl**: Install and configure kubectl to connect to your cluster
4. **doctl**: Install DigitalOcean CLI tool
5. **Docker**: Install Docker for building images

## Quick Start

### 1. Set up your cluster
```bash
# Install doctl and authenticate
doctl auth init

# Create a Kubernetes cluster (adjust size as needed)
doctl kubernetes cluster create smile-cluster \
  --region nyc1 \
  --size s-2vcpu-4gb \
  --count 3 \
  --auto-upgrade \
  --surge-upgrade

# Get cluster credentials
doctl kubernetes cluster kubeconfig save smile-cluster
```

### 2. Set up container registry
```bash
# Create a container registry
doctl registry create smile-registry

# Login to the registry
doctl registry login
```

### 3. Build and push your Docker image
```bash
# Build the production image
docker build -t registry.digitalocean.com/smile-registry/smile-app:latest .

# Push to registry
docker push registry.digitalocean.com/smile-registry/smile-app:latest
```

### 4. Update configuration files

Before deploying, update the following files with your actual values:

#### `k8s/secrets.yaml`
- Update all secret values (database passwords, API keys, etc.)
- Generate a new Laravel APP_KEY: `php artisan key:generate --show`

#### `k8s/app.yaml`
- Replace `your-registry/smile-app:latest` with your actual image path
- Replace `your-domain.com` with your actual domain

### 5. Deploy to Kubernetes
```bash
# Apply all configurations
kubectl apply -f k8s/

# Check deployment status
kubectl get pods -n smile-app
kubectl get services -n smile-app
kubectl get ingress -n smile-app
```

### 6. Set up ingress and SSL

Install NGINX Ingress Controller:
```bash
kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v1.8.2/deploy/static/provider/cloud/deploy.yaml
```

Install cert-manager for SSL:
```bash
kubectl apply -f https://github.com/cert-manager/cert-manager/releases/download/v1.13.2/cert-manager.yaml
```

Create ClusterIssuer for Let's Encrypt:
```bash
cat <<EOF | kubectl apply -f -
apiVersion: cert-manager.io/v1
kind: ClusterIssuer
metadata:
  name: letsencrypt-prod
spec:
  acme:
    server: https://acme-v02.api.letsencrypt.org/directory
    email: thathsaramadhhusha@gmail.com
    privateKeySecretRef:
      name: letsencrypt-prod
    solvers:
    - http01:
        ingress:
          class: nginx
EOF
```

## Files Overview

### Docker Files
- `Dockerfile`: Multi-stage Docker build for the Laravel application
- `docker-compose.yml`: Local development environment
- `docker/nginx.conf`: NGINX configuration
- `docker/php.ini`: PHP configuration
- `docker/supervisord.conf`: Supervisor configuration for running multiple processes

### Kubernetes Files
- `k8s/namespace.yaml`: Kubernetes namespace
- `k8s/secrets.yaml`: Application secrets (passwords, API keys)
- `k8s/configmap.yaml`: Application configuration
- `k8s/mysql.yaml`: MySQL database deployment
- `k8s/redis.yaml`: Redis cache deployment
- `k8s/app.yaml`: Main Laravel application deployment and ingress
- `k8s/workers.yaml`: Queue workers and scheduler
- `k8s/autoscaling.yaml`: Horizontal Pod Autoscaler and Pod Disruption Budget

## Environment Variables

Make sure to set these environment variables in `k8s/secrets.yaml`:

### Required
- `APP_KEY`: Laravel application key
- `DB_PASSWORD`: Database password
- `APP_URL`: Your application URL

### Optional but Recommended
- `OPENAI_API_KEY`: For OpenAI integration
- `AWS_ACCESS_KEY_ID` & `AWS_SECRET_ACCESS_KEY`: For S3 file storage
- `MAIL_*`: Email configuration

## Monitoring and Logs

View application logs:
```bash
# Application logs
kubectl logs -f deployment/smile-app -n smile-app

# Worker logs
kubectl logs -f deployment/smile-worker -n smile-app

# Database logs
kubectl logs -f deployment/mysql -n smile-app
```

Scale the application:
```bash
# Manual scaling
kubectl scale deployment smile-app --replicas=5 -n smile-app

# Check HPA status
kubectl get hpa -n smile-app
```

## Troubleshooting

### Common Issues

1. **Image Pull Errors**: Make sure your cluster has access to your container registry
2. **Database Connection**: Verify database credentials in secrets
3. **SSL Certificate Issues**: Check cert-manager logs and DNS configuration
4. **Storage Issues**: Ensure DigitalOcean block storage is available in your region

### Useful Commands
```bash
# Get all resources in namespace
kubectl get all -n smile-app

# Describe a pod for troubleshooting
kubectl describe pod <pod-name> -n smile-app

# Execute commands in a pod
kubectl exec -it <pod-name> -n smile-app -- php artisan migrate

# Port forward for local testing
kubectl port-forward service/smile-app-service 8080:80 -n smile-app
```

## Security Considerations

1. **Secrets Management**: Never commit real secrets to version control
2. **Image Security**: Regularly update base images and scan for vulnerabilities
3. **Network Policies**: Consider implementing Kubernetes network policies
4. **RBAC**: Set up proper role-based access control
5. **Resource Limits**: Always set resource requests and limits

## Backup Strategy

1. **Database Backups**: Set up regular MySQL backups
2. **Storage Backups**: Backup persistent volumes
3. **Configuration Backups**: Keep deployment configurations in version control

## Production Checklist

- [ ] Update all secrets with production values
- [ ] Configure proper domain and SSL
- [ ] Set up monitoring and alerting
- [ ] Configure log aggregation
- [ ] Set up database backups
- [ ] Configure resource limits and requests
- [ ] Test autoscaling behavior
- [ ] Set up CI/CD pipeline for deployments

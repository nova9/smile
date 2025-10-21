1. install nginx ingress controller
```bash
kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v1.13.3/deploy/static/provider/scw/deploy.yaml
```

2. install cert manager
```bash
kubectl apply -f https://github.com/cert-manager/cert-manager/releases/download/v1.19.1/cert-manager.yaml
```

3. apply namespace.yaml
4. apply do_secret.yaml
5. apply issuer.yaml
6. apply secrets.yaml
7. apply mysql.yaml
8. apply configmap.yaml
9. apply app.yaml

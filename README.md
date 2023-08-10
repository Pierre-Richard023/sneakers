# Installation

Le projet requiert une version de PHP >= 8

## Installation

Pour procéder à l'installation du projet, il est nécessaire d'entrer les lignes de code suivantes :


```bash
git clone https://github.com/Pierre-Richard023/sneakers.git
```

```bash
composer install
```

```bash
npm install --force
```

```bash
symfony console doctrine:database:create
```
```bash
symfony console doctrine:fixtures:load
```

## Démarrage du projet

```bash
symfony serve
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
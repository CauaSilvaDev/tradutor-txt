# Projeto em PHP

Este arquivo PHP permite que os usuários enviem arquivos de texto para tradução para o português. Ele fornece um formulário de upload onde os usuários podem selecionar um ou mais arquivos. Depois que os arquivos são enviados, eles são verificados para garantir que sejam arquivos de texto e que não excedam 5MB. Se tudo estiver correto, os arquivos são traduzidos para o português e disponibilizados para download.

# Passo 1: Atualizar o Sistema

```markdown
sudo apt update && sudo apt upgrade -y
```

# Passo 2: Instalar Repositorio (Linux)

```markdown
sudo apt install translate-shell php
```
# Passo 3: Ativar Extensão (php.ini)

```markdown
extension=fileinfo
```

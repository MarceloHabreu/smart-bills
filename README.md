# 🌟 Smart Bills 💰

## Sobre o Projeto 📚
O **Smart Bills** foi desenvolvido como parte da entrega do Trabalho Discente Efetivo (TDE) na disciplina de **Engenharia de Software** durante o segundo semestre do curso de ADS. O objetivo do projeto era identificar um problema real e desenvolver um software completo, incluindo modelagem, implementação, banco de dados, documentação e testes. Como o professor deixou a escolha da linguagem de programação e do framework a nosso critério, decidi explorar um framework que tinha ouvido falar muito bem, mas ainda não havia utilizado: o **Laravel**.

Esse é um dos frameworks mais organizados e simples para construir uma aplicação completa, graças aos seus arquivos Blade, além da integração com React e outras bibliotecas e frameworks front-end. Foi uma experiência sensacional! Eu já havia utilizado PHP anteriormente, mas desta vez explorei o Laravel junto com seu ecossistema. Embora eu goste muito de Java com Spring Boot, devo admitir que fiquei bastante surpreendido com o Laravel.

O problema identificado foi a dificuldade de gerenciamento de pagamentos e organização financeira pessoal. Com isso, o **Smart Bills** foi criado para auxiliar usuários a manterem seus compromissos financeiros organizados, evitando atrasos, juros e multas, além de proporcionar uma visão clara dos gastos mensais. 💡

## Funcionalidades 🚀
- 🔐 Cadastro e login de usuários
- 🛠️ Gerenciamento de perfil
- 📋 Cadastro, edição e exclusão de contas financeiras
- 📊 Relatórios detalhados de gastos
- 🖨️ Exportação de dados em PDF e CSV
- 📌 Painel informativo (dashboard)
- 🔒 Segurança com autenticação e criptografia
- 📱 Interface responsiva e intuitiva

## Tecnologias Utilizadas 💻
- **Back-end:** PHP (Laravel)
- **Banco de Dados:** MySQL
- **Front-end:** Blade (Laravel), Bootstrap, Tailwind CSS
- **Design e Modelagem:** Figma, Lucidchart

## Estrutura do Código 🗂️
O projeto segue o padrão **MVC (Model-View-Controller)** para garantir organização, escalabilidade e facilidade de manutenção. A estrutura inclui:
- **Models:** Representação das entidades e regras de negócio.
- **Controllers:** Manipulação da lógica de aplicação.
- **Views:** Interface do usuário utilizando templates Blade.
- **Migrations e Seeders:** Configuração e popularização do banco de dados.

## Como Executar o Projeto 🛠️
Se deseja apenas **clonar e testar** o projeto ou aprimorá-lo, siga os passos abaixo:

### Pré-requisitos:
- 🐘 PHP (>= 8.0)
- 🎼 Composer
- 🗃️ MySQL
- 🛠️ Node.js e NPM (para assets front-end)

### Passos de Instalação:
1. Clone o repositório:
   ```sh
       git clone https://github.com/MarceloHabreu/smart-bills.git
   ```
2. Acesse a pasta do projeto:
   ```sh
   cd smart-bills
   ```
3. Instale as dependências:
   ```sh
   composer install
   npm install
   ```
4. Copie o arquivo de ambiente:
   ```sh
   cp .env.example .env
   ```
5. Configure o arquivo `.env` com suas credenciais do banco de dados.
6. Gere a chave da aplicação:
   ```sh
   php artisan key:generate
   ```
7. Execute as migrations e os seeders:
   ```sh
   php artisan migrate --seed
   ```
8. Inicie o servidor local:
   ```sh
   php artisan serve
   ```
9. Acesse o sistema em `http://localhost:8000` 🌐

## Demonstração 🎥
### Modelagem do Sistema 🛠️
- Diagrama de Casos de Uso
![Diagrama de Casos de Uso](https://github.com/MarceloHabreu/smart-bills/blob/main/Diagramas/Diagrama_casos_de_uso_SmartBills.png)

- Diagrama de Classes
![Diagrama de Classes](https://github.com/MarceloHabreu/smart-bills/blob/main/Diagramas/Diagrama_de_classes_SmartBills.png)

<div align="center">

### Diagrama Relacional
![Diagrama Relacional](https://github.com/MarceloHabreu/smart-bills/blob/main/Diagramas/DiagramaRelacional.png)

</div>


### Telas do Sistema 📸

- Tela Inicial
![Tela Inicial](https://github.com/MarceloHabreu/smart-bills/blob/main/screenshotsProject/tela_inicial.png)

- Tela de Login
![Tela de Login](https://github.com/MarceloHabreu/smart-bills/blob/main/screenshotsProject/tela_login.png)

- Tela de Cadastro
![Tela de Cadastro](https://github.com/MarceloHabreu/smart-bills/blob/main/screenshotsProject/tela_cadastro.png)

- Dashboard
![Dashboard](https://github.com/MarceloHabreu/smart-bills/blob/main/screenshotsProject/dashboard.png)
![Dashboard](https://github.com/MarceloHabreu/smart-bills/blob/main/screenshotsProject/info_dashboard.png)

- Gerenciamento de Contas (Home)
![Gerenciamento de Contas](https://github.com/MarceloHabreu/smart-bills/blob/main/screenshotsProject/home_com_contas.png)

- Perfil do Usuário
![Perfil do Usuário](https://github.com/MarceloHabreu/smart-bills/blob/main/screenshotsProject/perfil.png)

## Conclusão 🏁
O **Smart Bills** foi desenvolvido com o propósito de facilitar a gestão financeira pessoal, promovendo organização, controle e clareza nas responsabilidades financeiras dos usuários. Ele oferece uma interface amigável e intuitiva, incentivando hábitos financeiros mais conscientes e eficientes. 😊

Caso tenha interesse em aprimorar o projeto, fique à vontade para contribuir! 🌟🚀

## Referências 📚
- [Laravel - The PHP Framework for Web Artisans](https://laravel.com/)
- [Tailwind CSS - Laravel Integration Guide](https://tailwindcss.com/docs/guides/laravel)
- [Bootstrap](https://getbootstrap.com/)
- [SweetAlert2](https://sweetalert2.github.io/)
- [Lucidchart - Diagramas UML](https://www.lucidchart.com/pages/pt/diagrama-de-caso-de-uso-uml)


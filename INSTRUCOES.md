# Instruções para Configuração do E-mail

Para garantir a segurança das credenciais de e-mail, a senha não é mais armazenada diretamente no código. Siga os passos abaixo para configurar o envio de e-mails:

1.  **Crie uma cópia do arquivo `config.ini.example` e renomeie-a para `config.ini`.**

    Você pode fazer isso no terminal com o seguinte comando:
    ```bash
    cp config.ini.example config.ini
    ```

2.  **Abra o arquivo `config.ini` e preencha com suas credenciais de e-mail.**

    O arquivo terá o seguinte formato:

    ```ini
    ; Arquivo de configuração
    ; Preencha com suas credenciais

    MAIL_USER = "seu_email_aqui@exemplo.com"
    MAIL_PASS = "sua_senha_aqui"
    ```

    Substitua `"seu_email_aqui@exemplo.com"` e `"sua_senha_aqui"` com o nome de usuário e a senha do seu e-mail, respectivamente.

3.  **Certifique-se de que o arquivo `config.ini` não seja enviado para o seu repositório Git.**

    Para evitar que suas credenciais sejam expostas, o arquivo `config.ini` deve ser ignorado pelo Git. Se o seu projeto já tem um arquivo `.gitignore`, adicione a seguinte linha a ele:

    ```
    config.ini
    ```

    Se você não tem um arquivo `.gitignore`, crie um e adicione a linha acima.

Após seguir esses passos, o formulário de contato do seu site deverá funcionar corretamente.

# attendancelist
Attendance List

# Modelo de arquivo CSV para carga.
Cada linha corresponde a um registro, todos os registros deverão ser separados por ponto virgula “;”.
Toda lista a primeira linha será ignorada, ela será o cabeçalho do arquivo para formatação e entendimento das colunas.

## As colunas são:
_CODIGO:_ Código de controle para o cadastro e vínculos, campo obrigatório
_NOME:_ Nome da categoria, pode ser uma unidade, curso, grupo, etc. Campo Obrigatório
_PARENT:_ Esse campo deverá ser em branco apenas para o cadastro da categoria PAI, no exemplo essa categoria PAI é a unidade, para os outros cadastros essa coluna é obrigatória, deverá conter o CODIGO de amarração da categoria PAI
_OBS:_ Opcional caso queira descrever algum detalhe. Não deverá conter quebra de linha e/ou ponto-virgula
_PUSBLISHED:_ Opcional, usado com valor “0” (zero) caso queiram desativar algum registro. Caso não tenha nenhum valor será considerado por padrão o valor 1.

### Exemplos
### Unidades
CODIGO	|	NOME					|PARENT	|	OBS							|	PUBLISHED  
-----------------------------------------------------------------------------------------
UND		|	Faculdade de Valinhos	|		|	Unidade de ensino Valinhos	|	1  
UNC		|	Faculdade de Campinas	|		|	Unidade de ensino Campus 1	|	1  
18		|	Faculdade de Vinhedo	|		|								|	
>Aqui será gravado 3 unidades por não conter um valor para a coluna PARENT.  
  
### CURSOS
CODIGO	|	NOME			|	PARENT	|	OBS						|	PUBLISHED  
----------------------------------------------------------------------------------
ADM		|	Administração	|	UND		|	Curso de administração	|	1  
DIR		|	Direito			|	UNC		|	Curso de Direito		|	1  
ADM		|	Administração	|	UNC		|	Curso de administração	|	1  
>Três cursos cadastrados, 1 para a UND e dois para a UNC  
  
### ALUNOS
CODIGO	|	NOME				|	PARENT	|	OBS					|	PUBLISHED  
---------------------------------------------------------------------------------
546889	|	Abadia Margarida	|	UND,ADM	|	Administração UND	|	1  
421159	|	Abiale Nascimento	|	UNC,DIR	|	Curso direito UNC	|	1  
251445	|	Sousa Maia			|	UNC,ADM	|	Administração UNC	|	1  
>Nesse cadastro os alunos serão cadastrados e vinculados às suas unidades e cursos pelos dados fornecidos na coluna PARENT, esses dados deverão ser separados obrigatoriamente por virgula.   
>Nos arquivos CSV’s, os dados ficarão dessa forma  
  
### UNIDADE (unidade.csv)
    CODIGO;NOME;PARENT;OBS;PUBLISHED  
    UND;Faculdade de Valinhos;;Unidade de ensino Valinhos;1  
    UNC;Faculdade de Campinas;;Unidade de ensino Campus 1;1  
    18;Fama;;;  
  
  
### CURSO (curso.csv)
    CODIGO;NOME;PARENT;OBS;PUBLISHED  
    ADM;Administração;UND; Curso de administração;1  
    DIR;Direito;UNC; Curso de Direito;1  
    ADM; Administração;UNC; Curso de administração;1  
  
  
### ALUNO (aluno.csv)
    CODIGO;NOME;PARENT;OBS;PUBLISHED  
    546889;Abadia Margarida;UND,ADM;Administração;UND;1  
    421159;Abiale Nascimento;UNC,DIR;Curso direito;UNC;1  
    251445;Sousa Maia;UNC,ADM;Administração;UNC;1  
  
>Atenção a virgula separando o PARENT do CSV aluno.csv, se for introduzido um “;” no lugar da “,” os dados serão gravados de forma errada.  


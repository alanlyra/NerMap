#!/bin/bash

# Caminho para o arquivo de entrada
FPATH=$1

# Nome do arquivo de entrada
FNAME=$2

FID=${FNAME%.*}

# JAR do Transcritor
TRANSCRITOR_BIN="/home/transcritor/Transcritor.jar"

# Diretórios Relevantes
OUTPUT_DIR="/mnt/videos/"
MIDIA_DIR="midia/"
LOG_DIR="log/"

# Strings de conexão do SQL Server
# Essas devem ser variáveis de ambiente no futuro
MSSQL_SERVER="146.164.34.116,1433"
MSSQL_DB="VERDE_PROD_20180710"
MSSQL_USER="sa"
MSSQL_PASS="*senha13"

# Arquivo de log
LOG_FILE=$OUTPUT_DIR$LOG_DIR$FNAME.log
echo "Input media processing started for file $FPATH$FNAME. Logging information will be written to $LOG_FILE"

mkdir -p $OUTPUT_DIR$MIDIA_DIR $OUTPUT_DIR$LOG_DIR

# Fluxo de erro
error_exit () {
    errcode=$?

    # Verifica se $FID é um inteiro ( proteje contra SQL inject )
    REGEX_INT='^[0-9]+$'
    if ! [[ $FID =~ $REGEX_INT ]] ; then
        echo "ERROR: Invalid audience ifentifier $FID. Script aborted with code 1. Database will not be updated." &>> $LOG_FILE
        exit 1
    else
        # Altera status da audiencia para ERRO
        echo "ERROR: Script aborted with code $errcode." &>> $LOG_FILE
        echo "Setting audience processing status to ERROR" &>> $LOG_FILE
        MSSQL_QUERY="UPDATE transcritor.tb_audiencia SET st_transcricao = 'ERRO' WHERE id_audiencia=$FID"
        echo "$MSSQL_QUERY"
        #/opt/mssql-tools/bin/sqlcmd -S 146.164.34.116,3333 -U sa -P *senha13 -d VERDE_PROD_20180710 -Q "UPDATE transcritor.tb_audiencia SET st_transcricao = 'ERRO' WHERE id_audiencia=101"
        /opt/mssql-tools/bin/sqlcmd -S "$MSSQL_SERVER" -U "$MSSQL_USER" -P "$MSSQL_PASS" -d "$MSSQL_DB" -Q "$MSSQL_QUERY"  &>> $LOG_FILE
    fi

    echo "Original midia will be preserved at ""$OUTPUT_DIR$LOG_DIR""files/""$FNAME"" ." &>> $LOG_FILE

    # Armazena mídia original para análise
    mkdir -p "$OUTPUT_DIR""$LOG_DIR""files/"
    mv "$FPATH""$FNAME" "$OUTPUT_DIR""$LOG_DIR""files/""$FNAME" &>> $LOG_FILE

    echo "Cleaning up converted midia..." &>> $LOG_FILE
    # Remove mídia parcialmente convertida
    rm $OUTPUT_DIR$MIDIA_DIR$FID.webm $OUTPUT_DIR$MIDIA_DIR$FID.wav &>> $LOG_FILE

    echo "Done. Exitting"
    exit $errcode
}
trap error_exit ERR

echo -e "Processing input file" $FPATH$FNAME &>> $LOG_FILE

# Verifica se a transcrição já foi feita ou já está sendo feita.
if [ -f $OUTPUT_DIR$MIDIA_DIR$FID.wav ]; then
    echo "Transcription already in progess. Terminating..." &>> $LOG_FILE
    exit 0
fi

# Verifica se FID eh um numero inteiro. Caso contrario reporta no log e retorna erro.
REGEX_INT='^[0-9]+$'
if ! [[ $FID =~ $REGEX_INT ]] ; then
  exit 1
fi

# Converte o arquivo de midia original para os formatos wav e webm
ffmpeg -loglevel warning -n \
       -i $FPATH$FNAME \
       $OUTPUT_DIR$MIDIA_DIR$FID.webm \
       -ac 1 $OUTPUT_DIR$MIDIA_DIR$FID.wav  &>> $LOG_FILE

echo -e "Successful." &>> $LOG_FILE

echo -e "Handing over to transcript application..." &>> $LOG_FILE

# Executa transcritor
java -jar "$TRANSCRITOR_BIN" "$FID" &>> $LOG_FILE
#transcript "$FID" &>> $LOG_FILE

echo -e "Transcript application exitted successfully. Removing original media." &>> $LOG_FILE
rm "$FPATH""$FNAME" &>> $LOG_FILE

#!/bin/bash

ID=$1
NUM=$2
CAT="uploads/$ID.txt"
COUNT=2

echo $CAT

# Arquivo de log
LOG_FILE="logbash.log"

if ! [ $NUM -eq 1 ]; then
	until [ $COUNT -gt $NUM ]
	do
	  CAT+=" breakline.txt "
	  CAT+=" uploads/"
	  CAT+=$ID
	  CAT+="_"
	  CAT+=$COUNT
	  CAT+=".txt"
	  ((COUNT++))
	done
fi


echo $CAT

cat $CAT > relatorios/relatorio_$ID.txt

# Executa REN
cd ner && java -mx600m -cp "*:lib\*" edu.stanford.nlp.ie.crf.CRFClassifier -loadClassifier classifiers/own-ner-model.ser.gz -textFile ../relatorios/relatorio_$ID.txt > ../roadmaps/$ID-tagged.txt && cd ..

# Chama PHP 
php geraroadmap.php "$ID"







#Base 

#java -jar "$TRANSCRITOR_BIN" "$FID" &>> $LOG_FILE
#transcript "$FID" &>> $LOG_FILE

#sudo -u postgres -H -- psql -d roadmap -c "INSERT INTO prospec (id_prospec, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec) VALUES ($ID,'teste', 'teste', 2018, 2, 'PROCESSANDO')"

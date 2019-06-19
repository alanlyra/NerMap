#!/bin/bash

ID=$1

# Executa transcritor


java -mx600m -cp "*:lib\*" edu.stanford.nlp.ie.crf.CRFClassifier -loadClassifier classifiers/own-ner-model.ser.gz -textFile uploads/$ID.txt > roadmaps/$ID-tagged.txt
#java -jar "$TRANSCRITOR_BIN" "$FID" &>> $LOG_FILE
#transcript "$FID" &>> $LOG_FILE


#sudo -u postgres -H -- psql -d roadmap -c "INSERT INTO prospec (id_prospec, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec) VALUES ($ID,'teste', 'teste', 2018, 2, 'PROCESSANDO')"

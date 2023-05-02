# -*- coding: utf-8 -*-
"""
Created on Mon May  1 22:08:44 2023

@author: Xuezhen Dai
"""
import difflib
import mysql.connector
import random
import string
def connect():
    mydb = mysql.connector.connect(
        host = "127.0.0.1",
        port="3306",
        user = "root",
        db="finalproject",
        password="123"
        )
    mycursor = mydb.cursor()
    
def getlikeList(userId):
    mydb = mysql.connector.connect(
        host = "127.0.0.1",
        port="3306",
        user = "root",
        db="finalproject",
        password="123"
        )
    mycursor = mydb.cursor() 
    mycursor.execute("SELECT newsId FROM userlike where userId = '"+str(userId)+"'")
    nowresult = mycursor.fetchall()
    arrayReturn = []
    for i in nowresult:
        arrayReturn.append(i[0]);
    return arrayReturn

def getlikedUser(newsId):
    mydb = mysql.connector.connect(
        host = "127.0.0.1",
        port="3306",
        user = "root",
        db="finalproject",
        password="123"
        )
    mycursor = mydb.cursor()  
    mycursor.execute("SELECT userId FROM userlike where newsId = "+str(newsId))
    nowresult = mycursor.fetchall()
    arrayReturn = []
    for i in nowresult:
        arrayReturn.append(i[0]);
    return arrayReturn
def similarity(lista,listb):
    sm=difflib.SequenceMatcher(None,lista,listb)
    return sm.ratio()


mydb = mysql.connector.connect(
    host = "127.0.0.1",
    port="3306",
    user = "root",
    db="finalproject",
    password="123"
    )
mycursor = mydb.cursor()
mycursor.execute("SELECT DISTINCT userName FROM userinfo")
arrayUser = []
arraySimilarUser = {}
arrayUserLike = {}
myresult = mycursor.fetchall()
for i in myresult:
    arrayUser.append(i[0]);
    arrayUserLike[i[0]]=getlikeList(i[0])
   # get the list of what the user like
   #for every user get their likes.

for i in arrayUser:
    if len(arrayUserLike[i])==0:
        continue
    for n in arrayUserLike[i]:

        for m in getlikedUser(n):
            if m==i:
                continue
            arraySimilarUser[i]=[]
            arraySimilarUser[i].append(m)
            
for key in arraySimilarUser.keys():
    arraynow = arraySimilarUser[key]
    for i in range(len(arraynow)):
        for j in range(i+1,len(arraynow)):
            similarityi = similarity(arraynow[i], arraynow[key])
            similarityj = similarity(arraynow[j], arraynow[key])
            if similarityi<similarityj:
                temp = arraynow[i]
                arraynow[i] = arraynow[j]
                arraynow[j] = temp
                
dictSuggestion = {}
for i in arrayUser:

    for m in arraySimilarUser[i]:
        dictSuggestion[i]=[]
        dictSuggestion[i]=dictSuggestion[i]+arrayUserLike[m]

def ranstr(num):
    salt = ''.join(random.sample(string.ascii_letters + string.digits, num))
    return salt
# get the difference
for key,value in dictSuggestion.items():
    value = [x for x in value if x not in arrayUserLike[key]]
# add to the database
for key,value in dictSuggestion.items():
    count = 0
    for i in value:
        if count == 5:
            break
        sql = "INSERT INTO suggestionnews (userId,newsId,suggestionId) values (%s,%s,%s) "
        val = (key,i,ranstr(12))
        mydb.commit()
        mycursor.execute(sql,val)
        count=+1

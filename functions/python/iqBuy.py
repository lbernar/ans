from iqoptionapi.stable_api import IQ_Option
import logging
import random
import time
import datetime
import sys

logging.basicConfig(level=logging.DEBUG,filename='/Users/lucasbernardes/IQAPI/functions/python/buy.log',format='%(asctime)s %(message)s')
I_want_money=IQ_Option(sys.argv[1],sys.argv[2])
ACTIVES=sys.argv[3]
duration=int(sys.argv[4])
amount=int(sys.argv[5])
action=sys.argv[6]
id=(I_want_money.buy_digital_spot(ACTIVES,amount,action,duration))
print(id)
if id !="error":
    while True:
        check,win=I_want_money.check_win_digital_v2(id)
        if check==True:
            break
    if win<0:
        print("loss "+str(win))
    else:
        print("win "+str(win))
else:
    print("please try again")
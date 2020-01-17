from iqoptionapi.stable_api import IQ_Option
import logging
import random
import time
import datetime
import sys
import json

logging.basicConfig(level=logging.DEBUG,filename='/Users/lucasbernardes/IQAPI/functions/python/buy.log',format='%(asctime)s %(message)s')
I_want_money=IQ_Option(sys.argv[1],sys.argv[2])
callFunc=int(sys.argv[3])
ACTIVES=sys.argv[4]
duration=int(sys.argv[5])
amount=int(sys.argv[6])
action=sys.argv[7]
gale=sys.argv[8]
quant_gale=int(sys.argv[9])

profile=I_want_money.get_profile()
print(json.dumps(profile))

def getProfileInfo():
    profile=I_want_money.get_profile()
    print(json.dumps(profile))

def buy_order(ACTIVES,amount,action,duration,gale,quant_gale):
    id=(I_want_money.buy_digital_spot(ACTIVES,amount,action,duration))
    print(id)
    if id !="error":
        while True:
            check,win=I_want_money.check_win_digital_v2(id)
            if check==True:
                break
            time.sleep(1)
        if win<0:
            if gale == False:
                print("loss "+str(win))
            else:
                for i in range(quant_gale):
                    amount = amount * 2
                    new_bet_value = calc_next_bet(ACTIVES, amount, duration)
                    sleep_time = duration * 55
                    time.sleep(sleep_time)
                    id=(I_want_money.buy_digital_spot(ACTIVES,amount,action,duration))
                    while True:
                        check,win=I_want_money.check_win_digital_v2(id)
                        if check==True:
                            break
                        time.sleep(1)
                    if win<0:
                        if i < quant_gale:
                            continue
                        else:
                            print("loss "+str(win))
                    else:
                       print("win "+str(win)) 
        else:
            print("win "+str(win))
    else:
        print("please try again")

def get_profit(ACTIVES, duration):
    I_want_money.subscribe_strike_list(ACTIVES,duration)
    while True:
        data=I_want_money.get_digital_current_profit(ACTIVES, duration)
        if data != False:
            I_want_money.unsubscribe_strike_list(ACTIVES, duration)
            return(int(data))#from first print it may be get false,just wait a second you can get the profit
            break
        time.sleep(1)

def calc_next_bet(ACTIVES, amount, duration):
    current_profit = get_profit(ACTIVES, duration)
    diff_profit = (100 - current_profit) / 100
    new_bet_value = (amount * diff_profit) + amount
    return("%.2f" % round(new_bet_value,2))

# options = {
#     0 : getProfileInfo,
#     1 : buy_order
# }

# options[callFunc]() 
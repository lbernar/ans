from iqoptionapi.stable_api import IQ_Option
import logging
import random
import time
import datetime
import sys
import json
iqConnection=IQ_Option(sys.argv[1],sys.argv[2])
profile=iqConnection.get_profile()
print(json.dumps(profile))

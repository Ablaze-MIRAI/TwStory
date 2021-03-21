import json
import tweepy

env = json.load(open("System_API/env/keys.json", "r"))

auth = tweepy.OAuthHandler(env["CK"], env["CS"], env["CALL_BACK"])

try:
    auth_url = auth.get_authorization_url()
    print({"url": auth_url, "rquest_token": auth.request_token})
except:
    print("Error")


import json
import sys
import tweepy

env = json.load(open("C:\/Users\/raisan\/OneDrive\/ドキュメント\/project\/twstory\/System_API\/env\/keys.json", "r"))

auth = tweepy.OAuthHandler(env["CK"], env["CS"], env["CALL_BACK"])
auth.request_token["oauth_token"] = sys.argv[1]
auth.request_token["oauth_token_secret"] = sys.argv[2]
print(auth.get_access_token(sys.argv[2]))
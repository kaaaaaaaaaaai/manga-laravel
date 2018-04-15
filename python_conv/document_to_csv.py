import pandas as pd
from pprint import pprint
#from elasticsearch import Elasticsearch


def main():
    json = pd.read_json("./document.json")
    pprint(json["data"])

    csv = []
    for data in json["data"].iteritems():
        d = {
            "extension":data[1]["extension"],
            "id":data[1]["id"],
            "tags": ",".join(data[1]["tags"]),
            "plane_tags": ",".join(data[1]["tags"])
        }
        csv.append(d)

    vvv = pd.DataFrame(csv)
    vvv.to_csv("./data.csv")



if __name__ == '__main__':
    main()

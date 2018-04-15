import pandas as pd
from pprint import pprint
from elasticsearch import Elasticsearch


def main():
    json = pd.read_json("./document.json")
    pprint(json["data"])

    es = Elasticsearch("https://search-manga-image-sdozidc55hog2xc6ryonyshlja.ap-northeast-1.es.amazonaws.com")

    for data in json["data"].iteritems():
        d = {
            "extension":data[1]["extension"],
            "tags": data[1]["tags"],
            "plane_tags": data[1]["tags"]
        }
        pprint(es.index(index="prod", doc_type="image", id= data[1]["id"], body=d))



if __name__ == '__main__':
    main()

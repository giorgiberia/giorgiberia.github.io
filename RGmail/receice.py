import poplib
import email
from base64 import b64decode
from bs4 import BeautifulSoup
from html.parser import HTMLParser


pop3_server = 'pop.gmail.com'
pop3_port = '995'
username = 'beria.giorgi1@gmail.com'
password = 'zmuki.1256'

class MLStripper(HTMLParser):
    def __init__(self):
        self.reset()
        self.strict = False
        self.convert_charrefs= True
        self.fed = []
    def handle_data(self, d):
        self.fed.append(d)
    def get_data(self):
        return ''.join(self.fed)

def strip_tags(html):
    s = MLStripper()
    s.feed(html)
    return s.get_data()


M = poplib.POP3_SSL(pop3_server, pop3_port)
M.user(username)
M.pass_(password)

numMessages = len(M.list()[1])


def decode_header(header):
    decoded_bytes, charset = email.header.decode_header(header)[0]
    if charset is None:
        return str(decoded_bytes)
    else:
        return decoded_bytes.decode(charset)

def isHtml(text):
    return bool(BeautifulSoup(text, "html.parser").find())
#correct mail checker()
#unda gavaketot security tema md5 it dashifruli faili sadac moxdeba shemdegi ambebi iq ari chamotvlili hesh kodebi romeli  mail misamrtebidanac sheileba mivigot emaili
#services mivaba es faili

for i in range(0, numMessages):
    raw_email = b"\n".join(M.retr(i + 1)[1])
    parsed_email = email.message_from_bytes(raw_email)
    # print(parsed_email['From'].rsplit('<')[1].rsplit('>')[0])
    if(parsed_email['From'].find('beria.giorgi1@gmail.com')>0):
        print('=========== email #%i ============' % i)
        print('From:', parsed_email['From'])
        print('To:', parsed_email['To'])
        print('Date:', parsed_email['Date'])
        print('Subject:', decode_header(parsed_email['Subject']))
        for part in parsed_email.walk():
            if part.is_multipart():
                # maybe need also parse all subparts
                continue
            elif part.get_content_maintype() == 'text':
                text = part.get_payload(decode=True).decode(part.get_content_charset())
                # print('Text:\n', text)
                if(isHtml(text)):
                    print(strip_tags(text))
                else:
                    print(text)
            elif part.get_content_maintype() == 'application' and part.get_content_disposition() == 'attachment':
                name = decode_header(part.get_filename())
                body = part.get_payload(decode=True)
                size = len(body)
                print('Attachment: "{}", size: {} bytes, starts with: "{}"'.format(name, size, body[:50]))
            else:
                print('Unknown part:', part.get_content_type())
        print('======== email #%i ended =========' % i)

from peewee import *

DB_DATABASE = 'tsuki'
DB_USER = 'tkg'
DB_PASSWD = 'tsuki22'
DB_HOST = '127.0.0.1'
"""
DB_DATABASE = 'boardjui'
DB_USER = 'boardjui'
DB_PASSWD = 'jui95'
DB_HOST = '110.77.143.212'
"""

db = MySQLDatabase(DB_DATABASE, **{'host': DB_HOST,
                               'passwd': DB_PASSWD, 'user': DB_USER})
DB_PREFIX = "tsk_"

class UnknownFieldType(object):
    pass

class BaseModel(Model):
    class Meta:
        database = db

class Command(BaseModel):
    arg = TextField()
    main = CharField()

    class Meta:
        db_table = DB_PREFIX + 'command'

class Done(BaseModel):
    arg = TextField()
    main = CharField()

    class Meta:
        db_table = DB_PREFIX + 'done'

class Grader(BaseModel):
    name = CharField(primary_key=True)
    pid = IntegerField()

    class Meta:
        db_table = DB_PREFIX + 'grader'

class ProbInfo(BaseModel):
    avail = IntegerField()
    desc = TextField(null=True)
    fullname = TextField()
    id = CharField()
    link = TextField(null=True)
    memory = IntegerField()
    name = CharField()
    output = IntegerField()
    score = IntegerField()
    time = FloatField()

    class Meta:
        db_table = DB_PREFIX + 'prob_info'

class UcConfiguration(BaseModel):
    name = CharField()
    value = CharField()

    class Meta:
        db_table = DB_PREFIX + 'uc_configuration'

class UcPages(BaseModel):
    page = CharField()
    private = IntegerField()

    class Meta:
        db_table = DB_PREFIX + 'uc_pages'

class UcPermissionPageMatches(BaseModel):
    page = IntegerField(db_column='page_id')
    permission = IntegerField(db_column='permission_id')

    class Meta:
        db_table = DB_PREFIX + 'uc_permission_page_matches'

class UcPermissions(BaseModel):
    name = CharField()

    class Meta:
        db_table = DB_PREFIX + 'uc_permissions'

class UcUserPermissionMatches(BaseModel):
    permission = IntegerField(db_column='permission_id')
    user = IntegerField(db_column='user_id')

    class Meta:
        db_table = DB_PREFIX + 'uc_user_permission_matches'

class UcUsers(BaseModel):
    activation_token = CharField()
    active = IntegerField()
    display_name = CharField()
    email = CharField()
    last_activation_request = IntegerField()
    last_sign_in_stamp = IntegerField()
    lost_password_request = IntegerField()
    password = CharField()
    sign_up_stamp = IntegerField()
    title = CharField()
    user_name = CharField()

    class Meta:
        db_table = DB_PREFIX + 'uc_users'


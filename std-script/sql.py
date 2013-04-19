#!/usr/bin/python

import os.path
import sys
import time
import subprocess
from lib.getch import *
from time import localtime, strftime
import MySQLdb as mdb
from peewee import *
from lib.db_models import *

GRADER_LOG = 'grader.log'


def logs(msg, echo=True):
    global GRADER_LOG
    log_name = GRADER_LOG
    flog = open(log_name, "a")
    flog.write('@ %s >> %s\n' % (strftime("%H:%M:%S", localtime()), msg))
    if echo:
        print '@ %s >> %s' % (strftime("%H:%M:%S", localtime()), msg)


def get_lang(source):
    part = source.split('.')
    return part[-1]

# --- Seperated
logs("", False)

grader = {}
pr = lambda x: sys.stdout.write(x)
while True:
    time.sleep(1)

# --- Database session
    db.connect()
    cmd_all = Command.select()
    if cmd_all.count() == 0:
        db.close()
        time.sleep(1)
        continue
    fst_cmd = cmd_all[0]
    fullcmd = (fst_cmd.main, fst_cmd.arg)
    logs("Receive command : %s %s" % fullcmd)
    fst_cmd.delete_instance()
    inp = fst_cmd.main
    done_cmd = Done()
    done_cmd.main = fst_cmd.main
    done_cmd.arg = fst_cmd.arg
    done_cmd.save()
    db.close()

# --- Runing command
    if inp == 'h':
        print "s: start grader"
        print "k: stop grader"
        print "j: judge source"
        print "l: list grader"
        print "i: import problem"
    elif inp == 's':
        gname = fst_cmd.arg
        if gname in grader:
            print "Exist grader"
            continue
        cmd = ['./grader', gname]
        gd = subprocess.Popen(cmd)
        print "Start grader '%s' by pid %d" % (gname, gd.pid)
        grader[gname] = gd
        # --- Add grader to db
        db.connect()
        grd = Grader()
        grd.name = gname
        grd.pid = gd.pid
        grd.save(force_insert=True)
        db.close()
    elif inp == 'k':
        gname = str(fst_cmd.arg)
        if not gname in grader:
            print "grader '%s' is not running" % gname
            continue
        cmd = "touch %s/stop-%s" % (gname, gname)
        os.system(cmd)
        print "Stoped grader '%s'" % gname
        # --- Delete grader from db
        db.connect()
        qry = Grader.select().where(Grader.name == gname)
        qry[0].delete_instance()
        db.close()
    elif inp == 'l':
        gdel = []
        for gname in grader.iterkeys():
            if grader[gname].poll() is not None:
                gdel.append(gname)
        for p in gdel:
            del grader[p]
        for gname in grader.iterkeys():
            print gname, ':', grader[gname].pid
    elif inp == 'g':
        task_name = arg
    elif inp == 'i':
        arg = cmd.arg.split(' ')
        testcase = arg[0]
        task_name = arg[1]
        os.system("./import_prob %s %s" % (testcase, task_name))
    else:
        print "Command not found..."
        time.sleep(0.5)

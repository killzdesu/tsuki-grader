def compare(out, sol):
    fout = open(out, "r")
    fsol = open(sol, "r")
    con_out = fout.readlines()
    con_sol = fsol.readlines()
    con_out = [x.strip() for x in con_out]
    con_sol = [x.strip() for x in con_sol]
    con_out = filter(None, con_out)
    con_sol = filter(None, con_sol)
    fout.close()
    fsol.close()
    if len(con_sol) != len(con_out):
        return False
    for x in range(len(con_sol)):
        if con_sol[x] != con_out[x]:
            return False
    return True


def order(out, sol):
    fout = open(out, "r")
    fsol = open(sol, "r")
    con_out = fout.readlines()
    con_sol = fsol.readlines()
    fout.close()
    fsol.close()
    con_out.sort()
    con_sol.sort()
    fout = open(out, "w")
    fsol = open(sol, "w")
    for x in con_out:
        fout.write(x.strip())
        fout.write("\n")
    for x in con_sol:
        fsol.write(x.strip())
        fsol.write("\n")

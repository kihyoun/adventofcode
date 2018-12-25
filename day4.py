day4 = open("day4.txt", "r")
day4list = day4.readlines()

def line_cmp(line1, line2):
    datepart1 = line1.split("]")[0].replace("[", "")

print(day4list.sort())


exit
sortedLines = []

for line in day4.readlines():
    dateobj =  line.split("]")[0].replace("[", "").replace("]", "")
    sortedLines.append(dateobj)

sortedLines.sort()
print(sortedLines)
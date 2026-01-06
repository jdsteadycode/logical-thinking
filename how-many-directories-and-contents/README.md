## FOLDER EXPLORER

- initially, suppose an initial data is given where a folder can/ might contain some directories..
- i.e., If, A directory is a child of (root) directory
  - then it can include sub-directories as well.
  - or it doesn't have any sub directory within it.

# Basically, I tried to break the whole problem down into following:
*(1.)* What problem says:
- To Get a proper folder structure including it's sub directories as well.

*(2.)* How I approached:
**PHASE-1**
- Deal with the root directories..
- Then, get the initial/ direct sub directories of the parent dir..

**PHASE-2**
- As sub directories are related to child of parent directory itself. Right?
- So, I updated `getSubDirectories()` <code>function</code>.
    - Where initially, it was rendering direct sub directories.
    
    - *So, for each sub directory I called `getSubDirectories()` again until it has some data or empty.*

# Rest, code tells everything,
# Happy learning.
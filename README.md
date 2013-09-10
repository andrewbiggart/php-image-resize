php-image-resize
========================

A simple script to create a variation of different sized square thumbnails .

Overview
========================

- Images are renamed to avoid overwritting.
- Create as many different sized thumbnails as you want.
- Adjust the quality of each individual image.
- Select different locations for each image.

Parameters
========================

- Image quality.
- Image sizes.
- Image locations.
- Number of images created.

Usage
========================

Using this script should be (in thereory) be pretty straight forward.

- Set the quality you would like your thumbnails to be.
- Set the three different sizes for the thumbnails.
- Set the location for each thumbnail.
- Edit database information, shoudl you want to save the image location. (Optional)

Notes
========================
This scirpt doesn't currently save the orginal file, although that functionality can be easily added.

You can either echo the image, add the image location to a database, or both. I've currently included both options in the example, so feel free to tailor it to your needs.

Credits
========================

I did get the fucntion to crop the image from another script. But I've forgotten to bookmark it. So if it was yours, please let me know and I'll add your URL to the credits.

License
========================

The MIT License (MIT)

Copyright (c) 2013 Andrew Biggart

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

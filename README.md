# Build Your Own PHP Framework Screencast

## History

It all started in the December 2011, when Fabien Potencier released his multi-step tutorial [*Create your own framework... on top of the Symfony2 Components*](http://fabien.potencier.org/article/50/create-your-own-framework-on-top-of-the-symfony2-components-part-1). The tutorial was very well received by the community and became the de-facto stadard on how to write modern web applications.

In March 2012 I have decided to repackage the original tutorial in the form of video screencasts, so that even more members of the community, especially the visual learners, could be reached and tought the best practices of using Symfony2 Components. That is how [*Build Your Own PHP Framework Screencast Series*](http://object-oriented-php.com/2012/03/screencast-series-creating-own-php-framework-using-symfony2-components-episode-1/) came to be.

## Code

The screencast is build out of 12 episodes - each one of them is and improvement, or refactored version of the previous. That was the reason why Fabien didn't want to publish the source code of the tutorial. The tutorial is supposed to show the framework in the making, and not offer the final result. In his own words: 
>"this seris is about writing your own framework, not about creating a framework that you can use without modification".

I decided to include the source code for each episode as a separate folder. This way, on one hand, you can follow the evolution of the framework as the screencast progresses, on the other - you still get the benifit of working code - the framework version you can run from the each folder.

## Usage

To run the corresponding version of the framework you need to follow this simple steps: 

- go to the episode folder:

		$ cd episode_03
		
- update the dependencies (listed in the composer.json file):

		$ php composer.phar update
		
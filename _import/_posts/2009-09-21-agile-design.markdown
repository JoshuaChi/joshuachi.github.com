---
layout: post
title: Agile Design
---

h1. {{ page.title }} 

p(meta). 2009-09-21 21:25:21

<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">1.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">敏捷设计之着眼于当下的需求，不预测未来的需求和需要</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">2.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">敏捷开发应用设计原则取出代码中的smell，当没有这些糟糕的smell的时候， 他们不会iqu应用这些原则，仅仅因为是一个原则就无条件的遵循它是错误的 -- 这句话太深入我心了，三年来，终于找到证据证明我的想法了。我一向讨厌那些死板教条，为了原则而原则，在没有开始代码之前就把这些条条框框把我们框住，太他妈混球了。这也证明了，代码世界中，很多混饭的。</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">C7</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">----------------------------------------------</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">1.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">满足工程设计标准的唯一文档就是源码</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">2.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">粘滞性 - 做正确的事情要比做错误的事情困难</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">3.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">为过多的可能性做设计，致使系统中含有绝不会用到的结构，从而变得混乱</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">4.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">如果只是简单的copy and past带来的重复代码，还是有希望治理的。但很多事情由于系统过于庞大，A开发者编写了一段功能代码，B因为没有看到的A的代码，而又重新编写了一段，这样的代码功能一样，但很难被发现。这个问题想彻底避免，我觉得也是很困难的，这就要求开发者在开始编码前就对整个系统有个通透的了解。这就是为什么说招10个初级程序员，还不如招两个中级程序员，招五个中级程序员，还不如招两个高级程序员。</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">5.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">敏捷设计是一个过程，持续的应用原则，模式和实践来保持系统任何时候都做得尽可能的简单，干净，富于想象力。</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">（写到这里让我想到，微软的程序员是绝没有机会实践这些东西的，他们一定很渴望，但却不可得，窃喜。）</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">C8</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">-----------------------------------------------</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">1.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">被依赖最多的功能，要注意解耦</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">C9</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">-----------------------------------------------</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">1.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">所有的原则都是使得我们可以尽可能的接近理想，而决不可能达到理想</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">2.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">对于扩展是开放的，对于更改是封闭的。</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">这就是为什么有时候我们您愿增加一段新的功能代码单独处理我们的另一端逻辑，而不愿更改那块被依赖很多次的代码</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">3.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">OCP一定要提前预测什么地方需要应用此原则</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">4.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">首先开发重要的部件，尽早的，经常性的发布</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">5.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">OCP - 面向对象的核心，只有当应用这个原则的时候才能看到面向对象的好处</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">C10</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">------------------------------------------------</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">1.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">Liskov替换原则 - 子类型必须能替换掉它的基类型</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">2.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">读到这里又让我想起当初学习那么多的定理，推论的用处了，很多的都用在这里了</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">3.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">Design By Contract(DBC) - 契约是通过为每个方法声明前置条件和后置条件来指定的。要是一个方法的一执行，前置方法必须为真，在执行结束后，后置方法必须为真。</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">4.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">为使第三方程序可控，可以将它们包装于你自己可以控制的函数内，以便未来什么时期将它替换掉。</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">C11</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">---------------------------------------------------</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">1.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">高层模块不依赖于底层模块，二者都依赖于抽象</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">抽象不依赖于细节，细节依赖于抽象</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">2.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">程序中所有的依赖关系都应该终止与抽象或者接口</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">C12</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">---------------------------------------------------</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">1.</div>
<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden;">多重继承分离接口</div>
1.

敏捷设计之着眼于当下的需求，不预测未来的需求和需要

2.

敏捷开发应用设计原则取出代码中的smell，当没有这些糟糕的smell的时候， 他们不会iqu应用这些原则，仅仅因为是一个原则就无条件的遵循它是错误的 -- 这句话太深入我心了，三年来，终于找到证据证明我的想法了。我一向讨厌那些死板教条，为了原则而原则，在没有开始代码之前就把这些条条框框把我们框住，太他妈混球了。这也证明了，代码世界中，很多混饭的。

C7

----------------------------------------------

1.

满足工程设计标准的唯一文档就是源码

2.

粘滞性 - 做正确的事情要比做错误的事情困难

3.

为过多的可能性做设计，致使系统中含有绝不会用到的结构，从而变得混乱

4.

如果只是简单的copy and past带来的重复代码，还是有希望治理的。但很多事情由于系统过于庞大，A开发者编写了一段功能代码，B因为没有看到的A的代码，而又重新编写了一段，这样的代码功能一样，但很难被发现。这个问题想彻底避免，我觉得也是很困难的，这就要求开发者在开始编码前就对整个系统有个通透的了解。这就是为什么说招10个初级程序员，还不如招两个中级程序员，招五个中级程序员，还不如招两个高级程序员。

5.

敏捷设计是一个过程，持续的应用原则，模式和实践来保持系统任何时候都做得尽可能的简单，干净，富于想象力。

（写到这里让我想到，微软的程序员是绝没有机会实践这些东西的，他们一定很渴望，但却不可得，窃喜。）

C8

-----------------------------------------------

1.

被依赖最多的功能，要注意解耦

C9

-----------------------------------------------

1.

所有的原则都是使得我们可以尽可能的接近理想，而决不可能达到理想

2.

对于扩展是开放的，对于更改是封闭的。

这就是为什么有时候我们您愿增加一段新的功能代码单独处理我们的另一端逻辑，而不愿更改那块被依赖很多次的代码

3.

OCP一定要提前预测什么地方需要应用此原则

4.

首先开发重要的部件，尽早的，经常性的发布

5.

OCP - 面向对象的核心，只有当应用这个原则的时候才能看到面向对象的好处

C10

------------------------------------------------

1.

Liskov替换原则 - 子类型必须能替换掉它的基类型

2.

读到这里又让我想起当初学习那么多的定理，推论的用处了，很多的都用在这里了

3.

Design By Contract(DBC) - 契约是通过为每个方法声明前置条件和后置条件来指定的。要是一个方法的一执行，前置方法必须为真，在执行结束后，后置方法必须为真。

4.

为使第三方程序可控，可以将它们包装于你自己可以控制的函数内，以便未来什么时期将它替换掉。

C11

---------------------------------------------------

1.

高层模块不依赖于底层模块，二者都依赖于抽象

抽象不依赖于细节，细节依赖于抽象

2.

程序中所有的依赖关系都应该终止与抽象或者接口

C12

---------------------------------------------------

1.

多重继承分离接口
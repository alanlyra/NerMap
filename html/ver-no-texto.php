<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_arquivo = $_POST["identificador"];

      $nome1 = get_data("SELECT nome_arquivo FROM arquivos WHERE id_arquivo =".$id_arquivo);
      $row = pg_fetch_array($nome1);        
      $nome_arquivo = $row[0];    

      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Ver no arquivo ".$nome_arquivo."</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div id='content-file' class='modal-body'>";

             
                echo "<div>
                <input type='text' id='search-term' />
                <input type='submit' id='search-button' value='search' />
                <button id='next'>next</button>
                <a href='/uploads/".$id_arquivo.".txt' download><div><img src='img/download.png' title='Fazer o download' style='width: 20px; height: 20px; float:right; margin: -10px 5px 2px 0px; opacity: 60%;'/></a>
                </div>
                <div id='bodyContainer' style='overflow:auto; width:100%; height:600px;'>
                <p class='emptyBlock1000' id='iframeText'>
                Faced with this scenario, McGahey
suggests exists a path towards the
introduction of a UBI as a floor to provide a
basic level of subsistence as a complement
to existing policies of the welfare state, or in
some cases as a substitute for the welfare
state [107].
6.2. WILL AUTOMATION DESTROY OR
ENHANCE THE ECONOMY?
 Technology alone will not determine
economic results in terms of growth,
inequality, or employment. All leading
economies have had access to similar levels
of technology, but have had very different
outcomes throughout history because they
have had different institutions and policies
[121].
Although today less than 5% of the
occupations can be fully automated [14],
the increasing automation will affect almost
all occupations, not only factory workers
and employees, but also landscaping
gardeners and dental laboratory
technicians, stylists, insurance sales
representatives and CEOs to a greater or
lesser extent.
Technological progress is the main
driver of per capita GDP growth, allowing
output to rise faster than labor and capital.
Increases in labor productivity generally
translate into increases in average wages,
giving workers the opportunity to reduce
working hours and offer more goods and
services [121].
These economic benefits, however, will
not necessarily be evenly distributed in
society. For example, the 19th century was
characterized by technological changes that
raised the productivity of less skilled
workers relative to that of high-level
workers [121].
In the United States, about 46% of the
time spent on work activities in occupations
and industries is technically automatable,
based on current technologies. On a global
scale, it is estimated that the adaptation of
the currently developed automation
technologies could affect 50% of the
working hours in the global economy [14].
This automation potential corresponds
to the equivalent of 1.2 billion workers and
to US$ 14.6 trillion in wages. Among
countries, the potential ranges from 41 to
56 percent, with only four countries – China,
India, Japan and the United States –
accounting for just over half of all wages
and workers [14].
The effects of AI will be felt unequally
by the economy. New jobs will be created
directly in areas such as the development of
AI, as well as indirectly created in a variety
of areas across the economy, as higher
revenues lead to demand expansion [121].
The economy has repeatedly shown to
be able to cope with this scale of change,
although it depends on how quickly
changes occur and on what concentrations
of losses on specific tasks [121].
6.3. WILL THE ADVANCES IN TECHNOLOGY
INCREASE INEQUALITY?
Advances in technology are going to
change the dynamic in the labor market.
Automation will increase unemployment
and that will aggravate inequality [122]. On
the other hand, there will be other ways to
organize production. Alternative, sharing,
social, green and creative economy will
become more popular. Social banks will
support these initiatives. For that reason,
poverty is going to decrease and people will
need to be able to reinvent themselves for
finding alternative methods to make money
[123].
The race between institutes and
technology will force companies to reinvest
money in expensive machines. The
competition between small companies and
big companies is going to be unfair due to
investment power differences. In this
scenario, small companies are going to
close their doors and big companies are
going to control the Market dynamics [124].
Academy and government are
important pieces in that discussion. They
have responsibility for creating and
fomenting technology, respectively. New
technologies may be used as a mechanism 
Esping-Andersen advocates a
classification into three categories of care
states: Liberal; Conservative or Corporatist
and Social Democrat [108]. Thinking of
forms of regimes, implemented by nations,
UBI would play out differently in each of
these regimes, and in relation to the diverse
set of existing policies in each [107].
In the other hand, the Institute for the
Future 10 understands that Universal Basic
Assets (UBA) is a fairer way of challenging
inequality. The UBA is a core set of
resources that everyone should have,
including housing, education, healthcare
and financial security and has been
proposed as a way to avoid economic
disasters by properly assessing and
distributing our resources to meet the
needs of each person. It can be seen as an
evolution of the UBI concept, which gives
each citizen a fixed amount of guaranteed
money, regardless of how much they earn
[109].
The development of emerging markets
will create many business opportunities.
These opportunities will arise as these
countries progress into industries and
engage the world with their growing
population. Even on 2050, the population
from developing countries will be younger
than the ones in developed countries [115].
On developed countries, population
ageing distribution is shifting towards older
ages. In these countries, birth control
methods are helping to reduce the number
of born children and the elderly population
is living even more because of the advances
in technology. On developing countries, the
effects of the population growth problem
are much harder to observe, because this
change is happening at a slower pace. As
people live longer, they will have to
continue working to make the pension
schemes affordable and this will probably
cause some negative effect on youth
employment.
The number of people in the cities will
also grow, for two main reasons. First, the
total population on Earth is growing, and
second, people living on rural areas are
migrating to urban areas – large and
medium cities. By 2050, 86% of the
developed countries’ population, and 64%
of the developing countries’ population will
be urbanized. This behavior shows some
negatives and positives trends, urbanization
may cause unplanned growth of cities,
health hazards caused by air and water
pollution and unemployment. On the other
hand, urbanization can bring reduction to
expenses on transports, education and
create diversity [113].
By 2050, part of the workforce will be
automated to better suit the new world
market. Tasks like translation, legal research
and low level journalism will be done by
machines [115].
Most of the difficulties for automation
today are the areas where the income wage
is already low. For instance, areas such as
fast food, retail and telemarketing keep
automation at bay because of the prices of
the automation equipment [116]. However,
the technology will become cheaper and the
tradeoff will make sense. Table 2 shows the
probability of automation of a set of jobs in
the next decades [36].
The changes in work and technology
derive another tendency for the future, the
inequality [113] [116]. There are many types
of inequality, like of rights, access,
participation and protection. Some of them
are widespread across the countries and 
Recent UBI experiments include
Finland, in which 2,000 unemployed people
between the ages of 25 and 58 will receive a
basic income of €560 a month for two years
[110]; and Ontario (Canada), in which
approximately 4,000 people will receive a
complementary basic income up to C$
16,989 per year (C$ 24,027 for couples) –
while keeping other previous benefits [111].
Switzerland, in its turn, massively rejected a
UBI proposal of CHF 2,500 monthly for
every adult Swiss citizen in 2016 [112].  Gender equality itself has been
improving over the last decades but there is
still a lot to be done for women rights in
several countries with some critical cases as
some countries in North Africa and Middle
East. As shown by Figure 4, the gender gap
has been slowly reducing with subindexes
as health and education reaching values
close to 1 (equality) but the economic and
political subindexes are still far from
equality. Considering the current trend, the
gender gap would only close in 83 years
[101]. Discrimination towards women
happens throughout their lives, sometimes
even before birth as some parents prefer to
have a son rather than a daughter leading
to strategies such as sex-selective abortions.
It also happens intra-household via
selective resource allocation (parents tend
to invest more in the education of their son)
and in the society (i.e. lower participation in
paid work than men, lower wages than men
for same positions) [102].
What about the role of technology in
the economic equality? Some researchers
defend that the exponential change in the
technology that sustains the economic
system is the main driver behind the
growing inequality. Digital technology acts
as a catalyzer of the economic payoff to the
winners in our modern economy as the
others become increasingly dispensable
and receive fewer resources. The winners
are those who accumulated the right capital
assets, either nonhuman (e.g. equipment,
real estate and financial assets) or human
(e.g. training, experience and skills), or the
superstars among us that have special
talents (or luck) (e.g. famous soccer players,
singers and CEOs) [103]. We cannot speak of
inequality without considering the racial
inequality. If we take the United States as
an example, Native, African and Latin
Americans have a Human Development
Index value lower than that of Asian and
White Americans. Taking the inequality
between White/Asian and African
Americans, the difference between the
value of several social indicators such as life
expectancy, wages, education, employment
and incarceration show a startling disparity
among these racial groups [102].
Some advances have been made in
reducing racial inequality. In the US, for
instance, the white-black gap in high school
completion rates has been reduced.
Meanwhile, other indicators show that little
change or even a worsening of the
inequality. This is clear in the case of
household income: in 1967, the median
adjusted income for households headed by
whites was US$ 44,700 and by blacks was US$ 24,700; 2014 data shows that this gap
has widened as the first group income went
up to US$ 71,300 while the second raised to
US$ 43,300 [104]. Universal Basic Income (UBI) can be
defined as an income paid by a political
community to all its members on an
individual basis, without the need for
means or labor requirements [105]. This
concept is also known as Unconditional
Basic Income [106]. For McGahey [107],
social welfare states face challenges of
economic growth and employment,
consequences arising from rising costs of
benefits, demographic changes and job
losses caused by information technology
and computerization. Such a combination
pressures societies to explore new ways of
offering welfare benefits, or building a new 
 
             </p>
                </div>
                </div>";
              
             /* echo "<div id='bodyContainer'>
              <p id='iframeText'>test texto fora do iframe</p>
              </div>";*/
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
            </div>
          </div>";

    
        
  ?>

  <script>

  /*$('#iframeText').load("/uploads/1.txt");*/
  
  /*$.ajax({
      url : "/uploads/1.txt",
      dataType: "text",
      success : function (result) {
          $("#iframeText").html(result);
      }
  });*/
   

  function searchAndHighlight(searchTerm, selector) {
    if(searchTerm) {
        //var wholeWordOnly = new RegExp("\\g"+searchTerm+"\\g","ig"); //matches whole word only
        //var anyCharacter = new RegExp("\\g["+searchTerm+"]\\g","ig"); //matches any word with any of search chars characters
        var selector = selector || "#bodyContainer";                             //use body as selector if none provided
        var searchTermRegEx = new RegExp(searchTerm,"ig");
        var matches = $(selector).text().match(searchTermRegEx);
        if(matches) {
$('.highlighted').removeClass('highlighted');     //Remove old search highlights
                $(selector).html($(selector).html().replace(searchTermRegEx, "<span class='match'>"+searchTerm+"</span>"));
           $('.match:first').addClass('highlighted');
            $('#next').on('click',i=1, function()
        {                                                                   $('.match').removeClass('highlighted');                                                                   $('.match').eq(i).addClass('highlighted');         
          i=i+1;  
     }); 
   
            
            
            
            if($('.highlighted:first').length) {             //if match found, scroll to where the first one appears
                $('#bodyContainer').scrollTop($('.highlighted:first').position().top);
            }
            return true;
        }
    }
    return false;
}
$(document).ready(function() {
    $('#search-button').on("click",function() {
        if(!searchAndHighlight($('#search-term').val())) {
            alert("No results found");
        }
    });
});

</script>




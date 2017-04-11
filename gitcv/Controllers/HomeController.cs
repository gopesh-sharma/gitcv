using System;
using System.Collections.Generic;
using System.Linq;
using System.Web.Mvc;
using gitcv.Models.Services;
using Octokit;

namespace gitcv.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            return View();         
        }

        [HttpPost]
        public ActionResult Index(string loginName)
        {

            if (String.IsNullOrEmpty(loginName))
            {
                ViewBag.ErrorMessage = "Please enter a github username.";
                return View("Index");
            }

            return RedirectToAction("Results", "Home", new { loginName = loginName });
        }

        public ActionResult Results(string loginName)
        {
            var user = new User();
            var languages = new Dictionary<string, int>();
            var repos = new List<Repository>();
            var mainRepos = new List<Repository>();
            var forkRepos = new List<Repository>();

            try
            {
                user = GithubService.GetUser(loginName);
                repos = GithubService.GetRepositories(loginName).ToList();
                mainRepos = GithubService.GetMainOriginalRepos(repos);
                forkRepos = GithubService.GetMainForkedRepos(repos);
                languages = GithubService.GetLanguages(repos);
            }
            catch
            {
                ViewBag.ErrorMessage = "Sorry, that user doesn't exist on Github, please try again.";
                return View("Index");  
            }
            
            ViewBag.User = user;
            ViewBag.OriginalRepositories = mainRepos;
            ViewBag.ForkedRepositories = forkRepos;
            ViewBag.Languages = languages;
            
            return View();

        }
 
    }
}

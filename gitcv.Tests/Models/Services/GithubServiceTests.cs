using System.Linq;
using NUnit.Framework;
using gitcv.Models.Services;
using Octokit;

namespace gitcv.Tests.Models.Services
{
    [TestFixture]
    class GithubServiceTests
    {
        [Test]
        public void ShouldReturnUserLoginName()
        {
            var user = GithubService.GetUser("gopesh-sharma");
            Assert.AreEqual("gopesh-sharma", user.Login);
        }

        [Test]
        public void ShouldReturnRepositoryInformation()
        {
            var repos = GithubService.GetRepositories("gopesh-sharma");
            Assert.IsNotEmpty(repos.First().CloneUrl);
            Assert.AreEqual("gopesh-sharma", repos.First().Owner.Login);
        }

        [Test]
        public void ShouldGetRepositoryLanguages()
        {
            var repos = GithubService.GetRepositories("gopesh-sharma").ToList();
            var languages = GithubService.GetLanguages(repos);
            Assert.IsTrue(languages.Count > 3);
        }
    }
}

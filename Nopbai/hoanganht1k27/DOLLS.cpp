#include<bits/stdc++.h>
using namespace std;
const int N=100004;
int n,a[N],k;
long long ans=0;
multiset<int> s;
multiset<int> ::iterator it;
int main()
{
    freopen("DOLLS.INP","r",stdin);
    freopen("DOLLS.OUT","w",stdout);
    scanf("%d%d",&n,&k);
    for(int i=1;i<=n;i++)
    {
        scanf("%d",&a[i]);
    }
    sort(a+1,a+n+1);
    for(int i=1;i<=n;i++)
    {
        it=s.upper_bound(a[i]-k);
        if(it!=s.begin())
        {
            it--;
            s.erase(it);
        }
        s.insert(a[i]);
    }
    for(it=s.begin();it!=s.end();it++)
    {
        ans+=*it;
    }
    cout<<ans;
}
